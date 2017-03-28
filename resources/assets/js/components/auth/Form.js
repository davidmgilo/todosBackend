import Errors from './Errors'

import axios from 'axios'

export default class Form {

    /*
     *  Constructor.
     */
    constructor(originalFields){
        this.fields = originalFields

        for (let field in originalFields){
            this[field] = originalFields[field]
        }

        this.errors = new Errors()
        this.submitting = false
    }

    /**
     *
     * Buida tot el formulari
     *
     */
    reset(){
        this.fields={}

        for (let field in this.fields){
            this[field] = ''
        }

        this.errors.clear()
    }

    data() {
        let data = {}

        for (let field in this.fields){
            data[field] = this[field]
        }

        return data
    }

    submit(requestType,url){
        this.submitting = true
        return new Promise((resolve,reject) =>{
            axios[requestType](url,this.data())
                .then( response =>{
                    this.onSuccess(response)
                    resolve(response)
                }).catch(error => {
                this.onFail(error)
                reject(error)
            })
        })

    }

    onSuccess(response){
        this.reset()
        this.submitting = false
    }

    onFail(error){
        console.log(error)
        this.errors.record(error.response.data)
        this.submitting = false
    }
}
