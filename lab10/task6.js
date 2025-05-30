const nums = { a: 1, b: 2, c: 3 };
function mapObject(obj, callback) {
    const result = {};
    for (let key in obj) {
        result[key] = callback(obj[key], key);
    }
    return result;
}

//var names = users.map(user => user.name);

console.log(mapObject(nums, x => x * 5)); // { a: 2, b: 4, c: 6 }