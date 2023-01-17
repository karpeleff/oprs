<template>
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <label>Время пуска</label>
                <datetime type="datetime"  v-model="date_start"  input-class="form-control  m-3" ></datetime>
                <label>Время останова</label>
                <datetime type="datetime"  v-model="date_stop"  input-class="form-control m-3" ></datetime>
               

                <label>Выбрать ДГУ</label>
              
                <select class="form-select m-3 " aria-label=""  v-model="des_select" >
                  
                    <option value="ADR16">ADR16</option>
                    <option value="SD6000E">SD6000E</option>
                  
                  </select>
               
                <label  class="" >Выбрать тип запуска</label>
                <select class="form-select m-3" aria-label=""  v-model="type_select">
                    <option value="Контрольный пуск">Контрольный пуск</option>
                    <option value="Авария промсети">Авария промсети</option>
                    <option value="Плановое отключение промсети">Плановое отключение промсети</option>
                </select>
               
                {{date_start}}
                <br>
                {{date_stop}}
                <br>
                {{des_select}}
                <br>
                {{type_select}}

                <br>
               
                <br>
                <button v-on:click="send_data" type="button" class="btn btn-success" >Сохранить </button>
                <button v-on:click="clear_data"  class="btn btn-info"  >Очистить</button>
            </div>
        </div>
    </div>
</template>

<script>
 import { Datetime } from 'vue-datetime';
    // You need a specific loader for CSS files
    import 'vue-datetime/dist/vue-datetime.css';
    import { Settings } from 'luxon';

    Settings.defaultLocale = 'ru';

    //Vue.use(Datetime)
    Vue.component('datetime', Datetime);

///////




    export default {
        data: function () {
            return {
                date_start: '',
                date_stop: '',
                des_select: '',
                type_select: ''

            }
        },
        methods:{
            send_data: function (){
                axios.post('des/add_time', {
                    date_start:  this.date_start ,
                    date_stop:   this.date_stop,
                    des_select:  this.des_select,
                    type_select: this.type_select

                })
                    .then(function (response) {
                        //console.log(response);
                        alert('Данные добавлены в базу');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            clear_data: function () {
                     this.date_start  = '',
                     this.date_stop   = '',
                     this.des_select  = '',
                     this.type_select = ''
            },
            


        },
        mounted() {
          
        },
        
    }

</script>
