/**
 * @param {number[]} prices
 * @return {number}
 */
var maxProfit = function(prices) {
    if(prices.length == 0) {
        return 0;
    }
    var min = prices[0], max = 0;
    for(var i=1; i<prices.length; i++) {
        max = Math.max(max, prices[i] - min);
        min = Math.min(min, prices[i]);
        console.log(max, min);
    }
    return max;
};

module.exports = {
    "maxProfit" : maxProfit
}