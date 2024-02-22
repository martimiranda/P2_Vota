// carreguem les llibreries
const { BasePhpTest } = require("./BasePhpTest.js")
const { By, until } = require("selenium-webdriver");
const assert = require('assert');

// heredem una classe amb un sol mètode test()
// emprem this.driver per utilitzar Selenium

class MyTest extends BasePhpTest
{
	async test() {
        // testejem LOGIN CORRECTE usuari predefinit
        //////////////////////////////////////////////////////
        /*await this.driver.get("http://localhost:8000/browser/www/");
        await this.driver.findElement(By.id("usuari")).sendKeys("ieti");
        await this.driver.findElement(By.id("contrasenya")).sendKeys("cordova");
        await this.driver.findElement(By.xpath("//button[text()='Login']")).click();

        // comprovem que l'alert message és correcte
        await this.driver.wait(until.alertIsPresent(),2000,"ERROR TEST: després del login ha d'aparèixer un alert amb el resultat de la validació de la contrasenya.");
        let alert = await this.driver.switchTo().alert();
        let alertText = await alert.getText();
        let assertMessage = "Login exitós";
        assert(alertText==assertMessage,"ERROR TEST: l'usuari ieti/cordova hauria d'entrar amb el missatge '"+assertMessage+"' en un alert.");
        await alert.accept();
        */

        await this.driver.get("http://localhost:8000/");
        var text = await this.driver.findElement(By.tagName("p")).getText();

        await this.driver.findElement(By.xpath("//a[text()='Registrarse']")).click();
        await this.driver.findElement(By.xpath("//input")).sendKeys("ejemplo");
        await this.driver.findElement(By.xpath("//button[text()='Validar']")).click();
        await this.driver.findElement(By.css("input[name='mail']")).sendKeys("ejemplo5@ejemplo.com");
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("input[name='tlf']")).sendKeys("888888341");
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("input[name='city']")).sendKeys("inventado");
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("input[name='postal_code']")).sendKeys("1111");
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("input[name='pwd1']")).sendKeys("12345678");
        await this.driver.findElement(By.css("input[name='pwd2']")).sendKeys("12345678");
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.css("div#box:last-child button")).click();
        await this.driver.findElement(By.xpath("//a[text()='Logearse']")).click();
        await this.driver.findElement(By.css("input[name='email']")).sendKeys("ejemplo5@ejemplo.com");
        await this.driver.findElement(By.css("input[name='password']")).sendKeys("12345678");
        await this.driver.findElement(By.css("div#box2:last-child button")).click();
        const textoError = await this.driver.findElement(By.css("div.error-window p")).getText();
        if(textoError.includes("valid")){
                console.log("TEST OK")
        }else{
                console.log("ERROR TEST: al registrar un nou usuari sense haber validat el email, no hauria de deixar logearse.")
        }



        
	}
}

// executem el test

(async function test_example() {
	const test = new MyTest();
	await test.run();
	console.log("END")
})();

