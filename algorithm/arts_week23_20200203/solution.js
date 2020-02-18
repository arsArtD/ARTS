/**
 * @param {number} capacity
 */
var LRUCache = function(capacity) {
    this.capacity = capacity;
    this.keyMap = new Set();
    this.queue = [];
};

/**
 * @param {number} key
 * @return {number}
 */
LRUCache.prototype.get = function(key) {
    if(this.keyMap.has(key)) {
        for(var i = 0; i < this.queue.length; i++) {
            if(this.queue[i].key == key) {
                var value = this.queue[i].value;
                this.queue = this.queue.slice(0,i).concat(this.queue.slice(i+1));
                this.queue.unshift({key: key, value : value});
                return value;
            }
        }
    }
    return -1;
};

/**
 * @param {number} key
 * @param {number} value
 * @return {void}
 */
LRUCache.prototype.put = function(key, value) {
    if(this.keyMap.has(key)) {
        var index = -1;
        for(var i = 0; i < this.queue.length; i++) {
            if(this.queue[i].key === key) {
                index = i;
                break;
            }
        }
        this.queue = this.queue.slice(0,index).concat(this.queue.slice(index+1));
    } else {
        this.keyMap.add(key);
    }
    this.queue.unshift({key: key, value : value});

    if(this.queue.length > this.capacity) {
        var pop = this.queue.pop();
        this.keyMap.delete(pop.key);
    }
};

module.exports = {
    'cache' : LRUCache
}