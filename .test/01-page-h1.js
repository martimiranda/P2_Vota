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
        var text = await this.driver.findElement(By.tagName("h1")).getText();

        assert( text=="Bienvenido Al Portal VotaYa", "Títol H1 de la pàgina incorrecte");

        console.log("TEST OK");
	}
}

// executem el test

(async function test_example() {
	const test = new MyTest();
	await test.run();
	console.log("END")
})();

