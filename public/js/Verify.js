class Verify {                                                              //Проверка ввода номера 
    constructor(arg) {
        const el = arg;
        this.keyup = function() {
            el.addEventListener('keyup', e => {
                if(el.value.match(/\s/g)){
                    this.spaceRemover();
                }
                el.style.backgroundColor = 'white';
                if (!parseInt(e.key)) {
                    if (el.value.match(/\w/)) {
                        el.value = el.value.replace(/[^\d \+]/gi, '');
                        this.spaceRemover();
                    } else {
                        this.removeAfterNum()
                    }
                }
                if (el.value[0] != '+') {
                    if (el.value[0] == 8) {                                    //Казахстан
                        this.phoneChange('+7');                                //Обрезка не требуется
                    }else if(el.value[0] == 0 && el.value[1] == 0){
                        if(el.value.match(/^00[5|6]/)){                        //Кыргызстан
                            this.phoneChange('+996',1)                         //Единица передается для обрезки массива на один элемент
                        }else if(el.value.match(/^009/)){                      //Узбекистан
                            this.phoneChange('+998',1)                         //Единица передается для обрезки массива на один элемент
                        }
                        }else if(el.value.match(/^9/)){                        //Таджикистан
                                this.phoneChange('+992',1)                     //Единица передается для обрезки массива на один элемент
                        }else if(el.value.match(/^[1-7]/)){                    //Совсем не наши абоненты
                            el.style.backgroundColor = '#ff43432e';
                        }
                }
            })
        }
        this.removeAfterNum = function() {
            if(el.value.length != 0){
                    let check = el.value.match(/\+\d+/g).join('');
                    el.value = check;
            }
        }
        this.phoneChange = function(phoneCode,arg2){
            let change = el.value.split('');
            change[0] = phoneCode;
            if(arg2){
                change.splice(1,arg2);                                    //По умолчанию удаляются элементы начиная с первого индекса по передаваемый аргумент
            }
            el.value = change.join('');
        }
        this.spaceRemover = function(){
            el.value = el.value.replace(/\s/g,'');
        }
    }
}