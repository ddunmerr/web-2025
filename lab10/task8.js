const numbers = [2, 5, 8, 10, 3];

function filterArray(arr) {
    let result = arr.map(num => num * 3);
    return result.filter(num => num > 10);;
}

console.log(filterArray(numbers));
/* БЕЗ ФУНКЦИИ:
var result = numbers.map(num => num * 3);
var filteredResult = result.filter(num => num > 10);
console.log(result); 
console.log(filteredResult); 
*/