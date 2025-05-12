// Генерация случайного флага
function generateRandomFlag(task) {
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    let flag = `JEST_${task}_`;
    
    for (let i = 0; i < 8; i++) {
        flag += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    
    return flag;
}

// Проверка флага
function verifyFlag(expectedFlag, userInput) {
    return expectedFlag === userInput;
}

// Показать подсказку
function showHint() {
    const hintDiv = document.getElementById('hint');
    hintDiv.style.display = hintDiv.style.display === 'none' ? 'block' : 'none';
}