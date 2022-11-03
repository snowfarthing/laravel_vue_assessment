<template>
  <div>
    <h2>Search By</h2>
    <form @submit.prevent="submitForm" v-if="!formSubmitted">
      <span>First Name</span> <input v-model="first_name" type="text" placeholder="first name" /><br>

      <span>Last Name</span>  <input v-model="last_name" type="text" placeholder="last name" /><br>

      <span>NPI Number</span>  <input v-model="npi_number" type="text" placeholder="npi number" /><br>

      <span>Taxonomy Description</span>  <input v-model="taxonomy_description" type="text" placeholder="taxonomy description" /><br>

      <span>City</span>  <input v-model="city" type="text" placeholder="city" /><br>

      <span>State</span>  <input v-model="state" type="text" placeholder="state" /><br>

      <span>ZIP CODE</span>  <input v-model="zip_code" type="text" placeholder="zip_code" /><br>

      <input class="submit" type="submit" value="Submit" />
    </form>
    <div v-if="formSubmitted">
      <h3>Form Submitted</h3>
      <p>First Name: {{ first_name }}</p>
      <p>Last Name: {{ last_name }}</p>
      <p>NPI Number: {{ npi_number }}</p>
      <p>Taxonomy Description: {{ taxonomy_description }}</p>
      <p>City: {{ city }}</p>
      <p>State: {{ state }}</p>
      <p>ZIP Code: {{ zip_code }}</p>
      <button @click="anotherSearch">Search Again</button>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        first_name: "",
        last_name: "",
        npi_number: "",
        taxonomy_description: "",
        city: "",
        state: "",
        zip_code: "",

        formSubmitted: false
      };
    },
    methods: {
      submitForm: function () {
        this.formSubmitted = true
      },
      anotherSearch: function () {
        this.formSubmitted = false
      },
    },
  };
</script>
<style>
  form {
    padding: 10px;
    border: 2px solid black;
    border-radius: 5px;
  }

  input {
    padding: 4px 8px;
    margin: 4px;
  }

  span {
    font-size: 18px;
    margin: 4px;
    font-weight: 500;
  }

  .submit {
    font-size: 15px;
    color: #fff;
    background: #222;
    padding: 6px 12px;
    border: none;
    margin-top: 8px;
    cursor: pointer;
    border-radius: 5px;
  }
</style>
