class Placeholder {
    constructor(arg, el) {          //Принимает массив сообщений и сам элемент куда писать
        let element = $(el);
        let textToAdd = "";
        let counter = 0;
        let subCounter = 0;
        let stop = false;
        let timeout = (time) =>{
        	setTimeout(() => {
                this.adding()
            }, time);
        };
        this.adding = () => {
        	if(element.val() != '' && !stop ){
        		stop = true;
        	}
            if ( arg[subCounter] != undefined && !stop ) {
                if (counter < arg[subCounter].length) {
                    textToAdd += arg[subCounter][counter];
                    element.attr('placeholder', textToAdd);
                    counter++;
                    timeout(100);
                } else {
                    textToAdd = "";
                    counter = 0;
                    subCounter++;
                    timeout(3000);
                }
            } else if (arg && el) {
                if(!stop) {
                	counter = 0;
                	subCounter = 0;
                	textToAdd = "";
                	timeout(200);
                } else {
                	element.attr('placeholder','Вы знаете что делать ;)');
                }
            } else {
            	window.location.href='http://www.oxyehho.com/';
            }
        }
    }
}