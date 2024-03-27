## vee-validate (Form Validation)
`npm install vee-validate`
1. VeeValidate is the most popular Vue.js form library. It takes care of value tracking, validation, errors, submissions and more.

`2. import {Form,  Field} from 'vee-validate'`

3. replace `<form>` tag with `<Form>` and `<input/>` tag with `<Field>` from vee-validate.

4. instead of v-model give name to Field i.e <br>
`<Field name="name" type="text" class="ur choice" placeholder="Enter Name"/>`

5. change button save type to submit and remove `@click`

## yup (Schema builder)
`npm install yup`
6. Yup is a schema builder for runtime value parsing and validation. Define a schema, transform a value to match, interdependent validations, or value transformation.

7. create validation schema __createUserSchema__ for validating form inputs

8. `import * as yup from 'yup'` 

9. inside `<Form @submit="createUser" :validation-schema="createUserSchema" v-slot="{errors}"/>` <br> 
add a submit like this and validation schema and errors will be the error return against validation schema.

10. after each Field add a span tag with associated errors.name i.e
`<span class="invalid-feedback"> {{ errors.email }} </span>`

11. also add a dynamic class to Field to each of the field i.e
__:class="{'is-invalid':errors.email}"__
