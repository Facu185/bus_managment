document.getElementById("staticsForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var fecha1 = document.getElementById("fDate").value;
    var fecha2 = document.getElementById("sDate").value;

    if (fecha1 == "" || fecha2 == "") {
        alert("Falta completar campos");
        return;
    }
    
    let meses = [];
    let precios = [];
    let compras = [];
    
    $.ajax  ({
        url: '../controllers/statics.php',
        method: 'POST',
        data: {
            fDate:fecha1,
            sDate:fecha2,
        }
    }).done(function (response) {
        var datos = JSON.parse(response);
        datos.forEach(element => {
            meses.push(element["Mes"]);
            precios.push(element["SumaPrecios"]);
            compras.push(element["Compras"]);
        });

        const graph = document.getElementById("barChart");

        const data = {
            labels: meses,
            datasets: [{
                label: "Total de precios por mes",
                data: precios,
                backgroundColor: 'rgb(69,177,223)',
            }]
        };
        
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        };
        
         new Chart(graph, config); 

        const graph2 = document.getElementById("barChart2");
        
        const data2 = {
            labels: meses,
            datasets: [{
                label: "Compras por mes",
                data: compras,
                backgroundColor: 'rgb(99,201,122)',
            }]
        };
        
        const config2 = {
            type: 'bar',
            data: data2,

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        };
        
        new Chart(graph2, config2); 


                })
            });




