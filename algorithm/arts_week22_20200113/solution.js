/**
 * @param {number[]} nums
 * @return {number}
 */
var removeDuplicates = function(nums) {
    var numLen = nums.length;

    for(var i = 0; i < numLen; i++) {
        for(var j = i+1; j < numLen; j++) {
            if(nums[j] == nums[i]) {
                // console.log(nums[j]);
                nums.splice(j,1);
                j--;
                numLen = nums.length;
            }
        }
    }
    // console.log(nums);
    return nums.length;
};

// removeDuplicates([1,1,2]);
removeDuplicates([0,0,1,1,1,2,2,3,3,4]);

module.exports = {
    'removeDuplicates' : removeDuplicates
};