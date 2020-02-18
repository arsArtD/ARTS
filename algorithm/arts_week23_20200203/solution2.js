// 双链表节点
function Node(val) {
    this.val = val
    this.prev = null
    this.next = null
}

var DoubleLink = function() {
    this.head = new Node(0)
    this.tail = new Node(0)
    this.head.next = this.tail
    this.tail.prev = this.head
    this.size = 0
}

/**
 * 在头部插入节点
 */
DoubleLink.prototype.addNode = function(node) {
    node.next = this.head.next
    this.head.next.prev = node
    node.prev = this.head
    this.head.next = node
    this.size++
}
/**
 * 移除一个节点
 */
DoubleLink.prototype.removeNode = function(node) {
    node.next.prev = node.prev
    node.prev.next = node.next
    this.size--
}

/**
 * @param {number} capacity
 */
var LRUCache = function(capacity) {
    this.capacity = capacity
    // 哈希表
    this.cache = {}
    this.link = new DoubleLink()
};

/** 
 * @param {number} key
 * @return {number}
 */
LRUCache.prototype.get = function(key) {
    if (this.cache.hasOwnProperty(key)) {
        // 将节点放到链表头部
        var node = this.cache[key]
        this.link.removeNode(node)
        this.link.addNode(node)
        return node.val.value
    } else {
        // 没有值，返回 -1
        return -1
    }
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LRUCache.prototype.put = function(key, value) {
    if (this.cache.hasOwnProperty(key)) {
        this.link.removeNode(this.cache[key])
    } else if (this.link.size === this.capacity) {
        // 如果之前已经有了当前 key 值，则删除对应的节点而非最后一个节点
        var delNode = this.link.tail.prev
        // 判断当前容量，如果容量已满，则删除最后一个节点
        this.link.removeNode(delNode)
        // 删除 key 值
        delete this.cache[delNode.val.key]
    }
    // 将节点插入头部
    var node = new Node({ key, value })
    this.link.addNode(node)
    this.cache[key] = node
};

module.exports = {
    'cache' : LRUCache
}