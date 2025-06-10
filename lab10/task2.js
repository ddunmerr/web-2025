function countVowels(str) {
    if (typeof str !== 'string') {
        console.error('Ошибка: параметр должен быть строкой');
        return;
    }

    const vowels = ['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я'];
    let count = 0;

    for (let ch of str.toLowerCase()) {
        if (vowels.includes(ch)) {
            count++;
        }
    }

    console.log(`Количество гласных: ${count}`);
    return count;
}

countVowels('Привет, мир!'); 
