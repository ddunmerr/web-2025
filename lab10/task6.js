const nums = { a: 1, b: 2, c: 3 };
function mapObject(obj, callback) {
    let result = {};
    for (let key in obj) {
        result[key] = callback(obj[key], key);
    }
    return result;
}

console.log(mapObject(nums, x => x * 3)); 