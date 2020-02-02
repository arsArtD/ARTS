


```
/* {{{ proto array array_unique(array input [, int sort_flags])
   Removes duplicate values from array */
PHP_FUNCTION(array_unique)
{
	zval *array;
	uint32_t idx;
	Bucket *p;
	struct bucketindex *arTmp, *cmpdata, *lastkept;
	unsigned int i;
	zend_long sort_type = PHP_SORT_STRING;
	compare_func_t cmp;

	ZEND_PARSE_PARAMETERS_START(1, 2)
		Z_PARAM_ARRAY(array)
		Z_PARAM_OPTIONAL
		Z_PARAM_LONG(sort_type)
	ZEND_PARSE_PARAMETERS_END();

	if (Z_ARRVAL_P(array)->nNumOfElements <= 1) {	/* nothing to do */
		ZVAL_COPY(return_value, array);
		return;
	}

	if (sort_type == PHP_SORT_STRING) {
		HashTable seen;
		zend_long num_key;
		zend_string *str_key;
		zval *val;

		zend_hash_init(&seen, zend_hash_num_elements(Z_ARRVAL_P(array)), NULL, NULL, 0);
		array_init(return_value);

		ZEND_HASH_FOREACH_KEY_VAL_IND(Z_ARRVAL_P(array), num_key, str_key, val) {
			zval *retval;
			if (Z_TYPE_P(val) == IS_STRING) {
				retval = zend_hash_add_empty_element(&seen, Z_STR_P(val));
			} else {
				zend_string *str_val = zval_get_string(val);
				retval = zend_hash_add_empty_element(&seen, str_val);
				zend_string_release(str_val);
			}

			if (retval) {
				/* First occurrence of the value */
				if (UNEXPECTED(Z_ISREF_P(val) && Z_REFCOUNT_P(val) == 1)) {
					ZVAL_DEREF(val);
				}
				Z_TRY_ADDREF_P(val);

				if (str_key) {
					zend_hash_add_new(Z_ARRVAL_P(return_value), str_key, val);
				} else {
					zend_hash_index_add_new(Z_ARRVAL_P(return_value), num_key, val);
				}
			}
		} ZEND_HASH_FOREACH_END();

		zend_hash_destroy(&seen);
		return;
	}

	cmp = php_get_data_compare_func(sort_type, 0);

	RETVAL_ARR(zend_array_dup(Z_ARRVAL_P(array)));

	/* create and sort array with pointers to the target_hash buckets */
	arTmp = (struct bucketindex *) pemalloc((Z_ARRVAL_P(array)->nNumOfElements + 1) * sizeof(struct bucketindex), Z_ARRVAL_P(array)->u.flags & HASH_FLAG_PERSISTENT);
	for (i = 0, idx = 0; idx < Z_ARRVAL_P(array)->nNumUsed; idx++) {
		p = Z_ARRVAL_P(array)->arData + idx;
		if (Z_TYPE(p->val) == IS_UNDEF) continue;
		if (Z_TYPE(p->val) == IS_INDIRECT && Z_TYPE_P(Z_INDIRECT(p->val)) == IS_UNDEF) continue;
		arTmp[i].b = *p;
		arTmp[i].i = i;
		i++;
	}
	ZVAL_UNDEF(&arTmp[i].b.val);
	zend_sort((void *) arTmp, i, sizeof(struct bucketindex),
			cmp, (swap_func_t)array_bucketindex_swap);
	/* go through the sorted array and delete duplicates from the copy */
	lastkept = arTmp;
	for (cmpdata = arTmp + 1; Z_TYPE(cmpdata->b.val) != IS_UNDEF; cmpdata++) {
		if (cmp(lastkept, cmpdata)) {
			lastkept = cmpdata;
		} else {
			if (lastkept->i > cmpdata->i) {
				p = &lastkept->b;
				lastkept = cmpdata;
			} else {
				p = &cmpdata->b;
			}
			if (p->key == NULL) {
				zend_hash_index_del(Z_ARRVAL_P(return_value), p->h);
			} else {
				if (Z_ARRVAL_P(return_value) == &EG(symbol_table)) {
					zend_delete_global_variable(p->key);
				} else {
					zend_hash_del(Z_ARRVAL_P(return_value), p->key);
				}
			}
		}
	}
	pefree(arTmp, Z_ARRVAL_P(array)->u.flags & HASH_FLAG_PERSISTENT);
}
/* }}} */
```
