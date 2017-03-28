export default class Errors {
  /*
   *  Constructor.
   */
  constructor(){
        this.errors = {}
  }

    //API

    /**
     * Determine if we have any errors
     */
    any(){
        return Object.keys(this.errors).length > 0
    }

    has(field){
        // Underscore | Lodash
        return this.errors.hasOwnProperty(field)
    }

    /**
     * Retrieve the error message for a field
     *
     * @param field
     * @returns {*}
     */
    get(field){
        if (this.errors[field]){
            return this.errors[field][0]
        }
    }

    /**
     * Return all errors
     * @param field
     * @returns {*}
     */
    getAllErrors(field){
        if (this.errors[field]){
            return this.errors[field]
        }
    }

    record(errors){
        this.errors = errors
    }

    clear(field){
        if(field){
            delete this.errors[field]

            return;
        }

        this.errors = {};
    }

}
