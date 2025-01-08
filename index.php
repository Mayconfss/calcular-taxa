<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Taxa</title>
    <style>
                    /* Alinha o container de cada campo */
            div {
                display: flex;
                flex-direction: column;
                margin-bottom: 10px;
            }

            /* Alinha os labels e inputs/selects */
            label {
                margin-bottom: 5px;
                font-size: 14px;
            }

            /* Ajusta os inputs e selects para ficarem do mesmo tamanho */
            input {
                padding: 8px;
                font-size: 14px;
                width: 10%; /* Faz os campos ocupar toda a largura disponível */
            }

            #numparcelas {
                padding: 8px;
                font-size: 14px;
                width: 5%;

            }

            #bandeira {
                padding: 8px;
                font-size: 14px;
                width: 10%;
                
            }

            /* Alinha os campos de entrada de forma mais compacta */
            h3 {
                margin-bottom: 20px;
            }
        
    </style>
</head>
<body>
    <h3>Calcular Taxa</h3>
    
    <div>
        <label for="receber">Quero Receber</label>
        <input type="text" id="receber" placeholder="0,00">
    </div><br>

    <div>
        <label for="parcelas">Nº Parcelas</label>
        <select name="parcelas" id="numparcelas">
            <option value="1">1x</option>
            <option value="2">2x</option>
            <option value="3">3x</option>
            <option value="4">4x</option>
            <option value="5">5x</option>
            <option value="6">6x</option>
            <option value="7">7x</option>
            <option value="8">8x</option>
            <option value="9">9x</option>
            <option value="10">10x</option>
            <option value="11">11x</option>
            <option value="12">12x</option>
            <option value="13">13x</option>
            <option value="14">14x</option>
            <option value="15">15x</option>
            <option value="16">16x</option>
            <option value="17">17x</option>
            <option value="18">18x</option>
        </select>
    </div><br>

    <div>
    <label for="bandeira">Bandeira</label>
        <select name="bandeira" id="bandeira">
            <option value="1">MasterCard</option>
            <option value="2">Visa</option>
            <option value="3">Outros</option>
        </select>
    </div><br>
    
    <div>
        <label for="cobrar">Valor a Cobrar</label>
        <input type="text" id="cobrar" placeholder="0,00" readonly>
    </div>

    <script>
        // Taxas para Visa e MasterCard
        const taxasVisaMaster = {
            1: 3.15,
            2: 4.19,
            3: 4.83,
            4: 5.46,
            5: 6.09,
            6: 6.71,
            7: 7.38,
            8: 7.99,
            9: 8.60,
            10: 9.19,
            11: 9.78,
            12: 10.38,
            13: 11.06,
            14: 11.64,
            15: 12.21,
            16: 12.79,
            17: 13.35,
            18: 13.91
        };

        // Taxas para bandeira "Outros"
        const taxasOutros = {
            1: 3.48,
            2: 4.34,
            3: 4.98,
            4: 5.61,
            5: 6.24,
            6: 6.86,
            7: 7.53,
            8: 8.14,
            9: 8.75,
            10: 9.34,
            11: 9.93,
            12: 10.53,
            13: 11.26,
            14: 11.84,
            15: 12.41,
            16: 12.99,
            17: 13.55,
            18: 14.11
        };

        // Função de máscara monetária
        function mascaraMonetaria(input) {
            input.addEventListener('input', () => {
                formatarCampo(input);
                calcularValorCobrar();
            });
        }

        // Formatar o campo para moeda
        function formatarCampo(input) {
            let valor = input.value.replace(/\D/g, ''); // Remove tudo que não for dígito
            valor = (parseFloat(valor) / 100).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            input.value = valor;
        }

        // Calcular o valor a ser cobrado
        function calcularValorCobrar() {
            const inputReceber = document.getElementById('receber');
            const numParcelas = parseInt(document.getElementById('numparcelas').value);
            const bandeira = document.getElementById('bandeira').value;
            const inputCobrar = document.getElementById('cobrar');

            let valorReceber = parseFloat(inputReceber.value.replace(/\./g, '').replace(',', '.'));

            let taxa;
            if (bandeira === '1' || bandeira === '2') { // Visa ou MasterCard
                taxa = (taxasVisaMaster[numParcelas] || 0) / 100;
            } else if (bandeira === '3') { // Outros
                taxa = (taxasOutros[numParcelas] || 0) / 100;
            }

            if (taxa) {
                const valorCobrar = valorReceber / (1 - taxa);
                inputCobrar.value = valorCobrar.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            } else {
                inputCobrar.value = inputReceber.value;
            }
        }

        // Aplicando a função de máscara monetária ao campo "receber"
        mascaraMonetaria(document.getElementById('receber'));

        // Recalcular valor ao mudar parcelas ou bandeira
        document.getElementById('numparcelas').addEventListener('change', calcularValorCobrar);
        document.getElementById('bandeira').addEventListener('change', calcularValorCobrar);
    </script>
</body>
</html>
