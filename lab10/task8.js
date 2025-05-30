const numbers = [2, 5, 8, 10, 3];

function filterArray(arr) {
    let result = arr.map(num => num * 3);
    let filteredResult = result.filter(num => num > 10);
    return filteredResult;
}

console.log(filterArray(numbers)); // { result: [ 6, 15, 24, 30, 9 ], filteredResult: [ 15, 24, 30 ] }

/* БЕЗ ФУНКЦИИ:
var result = numbers.map(num => num * 3);
var filteredResult = result.filter(num => num > 10);
console.log(result); 
console.log(filteredResult); 
*/