function createPass(length) {
    const specialCharacters = '!@#$%^&*()_+[]{}|;:,.<>?';
    const upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    const numbers = '0123456789';
    const allChars = specialCharacters + upperCase + lowerCase + numbers;
    let password = '';

    // Ensure at least one character from each category
    for (let i = 0; i < length; i++) {
        password += allChars[Math.floor(Math.random() * allChars.length)];
    }

    return password;
}
console.log(createPass(10)); // Example output: 'aB3dE5fG6H'