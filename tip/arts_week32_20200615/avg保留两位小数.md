

```
SELECT MAX(student_result) AS 最高分,MIN(student_result) AS 最低分,CAST(AVG(student_result) AS DECIMAL(10,2)) AS 平均分
FROM result
WHERE exam_date = '2016-02-17'
```
