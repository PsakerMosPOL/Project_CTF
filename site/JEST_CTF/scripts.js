function showHint() {
    const hintDiv = document.getElementById('hint');
    hintDiv.style.display = hintDiv.style.display === 'none' ? 'block' : 'none';
}

function submitFlag() {
    const flag = document.getElementById('flag-input').value;
    const outputDiv = document.getElementById('output');

    fetch('php/submit_flag.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `flag=${encodeURIComponent(flag)}`
    })
    .then(response => response.json())
    .then(data => {
        outputDiv.innerHTML = `<p class="${data.success ? 'success' : 'error'}">${data.message}</p>`;
        if (data.success) {
            setTimeout(() => location.reload(), 2000);
        }
    });
}

function fetchUser() {
    const userId = document.getElementById('user-id').value;
    const outputDiv = document.getElementById('output');

    fetch(`php/idor_leak.php?user_id=${userId}`)
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            outputDiv.innerHTML = `<p class="error">${data.error}</p>`;
        } else {
            let output = `<p>Username: ${data.username}</p><p>Email: ${data.email}</p>`;
            if (data.flag) {
                output += `<p class="success">Флаг: ${data.flag}</p>`;
            }
            outputDiv.innerHTML = output;
        }
    });
}