// console.log () prindib välja tekstikujul konsooli
console.log("Hello world!");

// if else näide
var tingimus = "asdasd" 


if (tingimus === true) {//condition1
console-log("mina olen ture"); // action1
} else if (tingimus === false) { // condition2 
console.log("Mina olen false"); // action2
} else {
    console.log("Mina oled vaikimisi väärtus"); //default action 
    }
    
    // if else näite lõpp 

    // arvutamise harjutus
    // // loome muutujad

    var num1 = 3;
    var num2 = 4; 
    var num3 = 5;

    var sum = num1 + num2 + num3;
    console.log("arvude summa:" + sum);

    var multiplied = num1 * num2 * num3;
    console.log("Arvude korrutis:" + multiplied);

    var maxNum = Math.max(num1, num2, num3);
        console.log("suurim arv" + maxNum);

    var minNum = Math.min(num1, num2, num3);
    console.log("väikseim arv"+ minNum);


    // ül 1 Kui number on paarisarv, siis prindi konsoooli "Arv on paarisarv ja tema ruut on: ?" 
    // Kui on paaritu, siis prindi konsooli arv on paaritu ja tema ruutjuur on: ?"
    // etteantud arv on 25, prindib välja arv on paaritu ja tema ruutjuur on: 5"
    // arvu astendamine funktsiooniga Math.pow(arv, astendaja), arvu ruutjuur: Math.sqrt(arv)
    // Arvu kontrollimine kas on paaris v paaritu, soovitan kasutada moodulit: näide if (arv % 2 === 0) {....}
    // see on paarisarvu kontroll, sest kahega arvu jagades jääb jäägiks 0)

    // Lahendus: 

    var num = 10; // seda arvu muudame, et näha teisi väljundeid// 

    if (num % 2 === 0) {
        var ruut = Math.pow (num, 2);
        console.log("Arv on paaris ja tema ruut on:" + ruut); 
    } else {
        var ruutjuur = Math.sqrt(num); // võtame arvust ruutjuure
        console.log("Arv on paaritu ja tema ruutjuur on:"+ruutjuur); //prindime välja 
    }
