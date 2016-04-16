
    function operationValue(){

        var OperationValue = document.getElementById("valor_operacion").value;
        console.log(OperationValue)
        document.getElementById("labelfee").innerHTML = "Honorarios: $" + FeebyOperationValue(OperationValue);
    }    

    function FeebyOperationValue( OperationValue ){
    	//La formula pra obtener un Honorario en bace al valor de operacion es
        //Honorarios = (tasa marginal sobrante del execente inferior * valor de operación) + Cuota fija 
        var TMEI = 0; //Tasa marginal sobre execente inferior 
        var cuotaFija = 0; 
        var fee = 0;

         if ( OperationValue <= 100000) {
             	fee = 2200; 
             return fee;
        }else if (OperationValue > 100000 && OperationValue <= 250000) {
            cuotaFija = 4500;
            TMEI = 1.5;
            diff = OperationValue - 100000;
            fee = ((TMEI * diff )/100) + cuotaFija;
            return fee;

        }else if (OperationValue > 250000 && OperationValue <= 500000) {
            cuotaFija = 8000;
            TMEI = 1.2;
            diff = OperationValue - 250000;
            fee = ((TMEI * diff )/100)  + cuotaFija;
            return fee;

        }else if (OperationValue > 500000 && OperationValue <= 750000) {
            cuotaFija = 12000;
            TMEI = 1.0;
            diff = OperationValue - 500000;
            fee = ((TMEI * diff) /100)  + cuotaFija;
            return fee;

        }else if (OperationValue > 750000 && OperationValue <= 1000000) {
            cuotaFija = 16000;
            TMEI = 0.8;
            diff = OperationValue - 750000;
            fee = ((TMEI * diff  )/100)  + cuotaFija;
            return fee;

        }else if (OperationValue > 1000000 && OperationValue <= 2000000) {
            cuotaFija = 24000;
            TMEI = 0.6;
            diff = OperationValue - 1000000 ;
            fee = ((TMEI * diff )/100) + cuotaFija;
            return fee;

        }else if (OperationValue > 2000000 && OperationValue <= 5000000) {
            cuotaFija = 45000;
            TMEI = 0.4;
            diff = OperationValue - 2000000;
            fee = ((TMEI * diff )/100)  + cuotaFija;
            return fee;

        }else if (OperationValue > 5000000 && OperationValue <= 10000000) {
            cuotaFija = 60000;
            TMEI = 0.2;
            diff = OperationValue - 5000000;
            fee = ((TMEI * diff )/100) + cuotaFija;
            return fee;

        }else if (OperationValue > 10000000 ) {
            cuotaFija = 750000;
            TMEI = 0.1;
            diff = OperationValue - 10000000 ;
            fee = ((TMEI * diff )/100)  + cuotaFija;
            return fee;

        }
    }