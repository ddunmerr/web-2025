function uniqueElements(arr) {
    const result = {};

    for (let item of arr) {
        let key = String(item);
        if (result[key]) {
            result[key]++;
        } else {
            result[key] = 1;
        }
    }

    return result;
}

let output = uniqueElements(['привет', 'hello', 1, '1']);
console.log(output);
