function isPrimeNumber(input) {
    if (typeof input === 'number') {
        checkAndPrint(input)
    } else if (Array.isArray(input)) {
        for (let value of input) {
            if (typeof value !== 'number') {
                console.error(`Ошибка: элемент массива "${value}" не является числом`)
                continue
            }
            checkAndPrint(value)
        }
    } else {
        console.error('Ошибка: параметр должен быть числом или массивом чисел')
    }


    function checkAndPrint(num) {
        if (num < 2) {
            console.log(`${num} не простое число`)
            return
        }

        for (let i = 2; i <= num - 1; i++) {
            if (num % i === 0) {
                console.log(`${num} не простое число`)
                return
            }
        }

        console.log(`${num} простое число`)
    }
}

isPrimeNumber([2, 'HUI', 4, 7, 9, 11, 13, 15, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97])