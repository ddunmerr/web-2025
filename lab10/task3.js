function uniqueElements(arr) {
    const result = {};

    for (let item of arr) {
        if (result[item]) {
            result[item]++;
        } else {
            result[item] = 1;
        }
    }

    return result;
}

let output = uniqueElements(['привет', 'hello', 1, '1']);
console.log(output);
