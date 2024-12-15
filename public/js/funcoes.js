function calcular(acao) {
    const numero = document.getElementById('numero').value;
    const csrfToken = document.getElementById('csrf_token').value;
    const resultadoDiv = document.getElementById('resultado');
    
    if (numero === '') {
        resultadoDiv.innerText = 'Por favor, insira um número.';
        return;
    }

    // Monta os dados para envio no corpo da requisição
    const data = new URLSearchParams();
    data.append('action', acao);
    data.append('numero', numero);
    data.append('csrf_token', csrfToken);

    // Realiza a requisição com Fetch API
    fetch('./calcular.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data.toString(), // Converte os dados para o formato esperado
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao processar a requisição.');
            }
            console.log('Resposta:', response);
            return response.text();
        })
        .then(result => {
            resultadoDiv.innerText = result;
        })
        .catch(error => {
            console.error('Erro:', error);
            resultadoDiv.innerText = 'Erro ao processar.';
        });
}

// Adiciona os eventos para os botões
document.querySelector('#somar').addEventListener('click', function(event) {
    event.preventDefault();
    calcular('somar');
});

document.querySelector('#multiplicar').addEventListener('click', function(event) {
    event.preventDefault();
    calcular('multiplicar');
});

/*
function calcular(acao) {
    const numero = document.getElementById('numero').value;
    const csrfToken = document.getElementById('csrf_token').value;
    const resultadoDiv = document.getElementById('resultado');
    
    if (numero === '') {
        resultadoDiv.innerText = 'Por favor, insira um número.';
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', `./calcular.php`, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            resultadoDiv.innerText = xhr.responseText;
        } else {
            resultadoDiv.innerText = 'Erro ao processar.';
        }
    };
    xhr.send(`action=${acao}&numero=${numero}&csrf_token=${csrfToken}`);
}


document.querySelector('#somar').addEventListener('click', function(event) {
    event.preventDefault();
    calcular('somar');
});

document.querySelector('#multiplicar').addEventListener('click', function(event) {
    event.preventDefault();
    calcular('multiplicar');
});
*/
