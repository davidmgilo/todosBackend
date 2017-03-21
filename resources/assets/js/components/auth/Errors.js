export default class Errors {
    /*
     *  Constructor.
     */
  constructor () {
    this.errors = {}
  }

    // API

  has (field) {
        // Underscore | Lodash
    return this.errors.hasOwnProperty(field)
  }

    /**
     * Retrieve the error message for a field
     *
     * @param field
     * @returns {*}
     */
  get (field) {
    if (this.errors[field]) {
      return this.errors[field][0]
    }
  }

  record (errors) {
    this.errors = errors
  }

  clear (field) {
    if (field) {

    }
  }
    // TODO clear
}
