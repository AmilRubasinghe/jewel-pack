import Validator from '../scripts/validator';

export default {
    data() {
        return{
            rules:{},
            validator:{},
        };
    },

    created(){
        this.validator=new validator({
            el: this,
            fields:this.form,
            rules: this.rules,
        })
    },

    methods:{
        getErrors(fields){
            return this.validator.getErrors(field)
        },
        setErrors(errors){
            this.validator.setErrors(errors)
        },
    },

    watch:{
        form:{
            deep:true,
            handler:function(val){
                this.validator.update(val)
            },
        },
    },

}