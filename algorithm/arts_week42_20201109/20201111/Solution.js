function Status(l, r, m, i) {
    this.lSum = l;
    this.rSum = r;
    this.mSum = m;
    this.iSum = i;
    console.log('lsum:%s, rsum: %s, msum: %s, isum: %s',
        l, r, m, i);
    //return 'lsum:'+l + 'rsum:' + r + 'msum:' + 'isum:' + i;
}

const pushUp = (l, r) => {

    console.log('sum: %s %s, %s, %s, %s', l.mSum, r.mSum, l.rSum, r.lSum, JSON.stringify(l));
    const iSum = l.iSum + r.iSum;
    const lSum = Math.max(l.lSum, l.iSum + r.lSum);
    const rSum = Math.max(r.rSum, r.iSum + l.rSum);
    const mSum = Math.max(Math.max(l.mSum, r.mSum), l.rSum + r.lSum);
    //console.log("msum:", l.mSum, r.mSum, l.rSum + r.lSum);
    //console.log('lsum: %s, %s, %s', l.lSum, l.iSum, r.lSum);
    // if(lSum == -1 && rSum == -2) {
    //     console.log('get it=================sum: %s %s, %s, %s', l.mSum, r.mSum, l.rSum, r.lSum);
    // }
    return new Status(lSum, rSum, mSum, iSum);
}

const getInfo = (a, l, r) => {
    if (l === r) {
        console.log('curr left: %s, curr right: %s', l, r);
        //console.log(a)
        return new Status(a[l], a[l], a[l], a[l]);
    }
    const m = (l + r) >> 1;
    const lSub = getInfo(a, l, m);
    const rSub = getInfo(a, m + 1, r);

    console.log('recored get curr result========: curr left: %s, left result: %s', l, JSON.stringify(lSub));
    console.log('recored get curr result========: curr right: %s, right result: %s', r, JSON.stringify(rSub));
    return pushUp(lSub, rSub);
}

var maxSubArray = function(nums) {
    return getInfo(nums, 0, nums.length - 1).mSum;
};

module.exports = {
    'maxSubArray' : maxSubArray
}
