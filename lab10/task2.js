function countVowels(str) {
    if (typeof str !== 'string') {
        console.error('Ошибка: параметр должен быть строкой');
        return;
    }

    const vowels = ['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я'];
    let count = 0;

    for (let char of str.toLowerCase()) {
        if (vowels.includes(char)) {
            count++;
        }
    }

    console.log(`Количество гласных: ${count}`);
    return count;
}

countVowels('Привет, мир!'); 
