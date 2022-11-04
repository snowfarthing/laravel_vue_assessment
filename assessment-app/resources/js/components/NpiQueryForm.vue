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
      <h3>Search Terms</h3>
      <div v-if="first_name">First Name: {{ first_name }}</div>
      <div v-if="last_name">Last Name: {{ last_name }}</div>
      <div v-if="npi_number">NPI Number: {{ npi_number }}</div>
      <div v-if="taxonomy_description">Taxonomy Description: {{ taxonomy_description }}</div>
      <div v-if="city">City: {{ city }}</div>
      <div v-if="state">State: {{ state }}</div>
      <div v-if="zip_code">ZIP Code: {{ zip_code }}</div>
      <button @click="anotherSearch">Search Again</button>
    </div>

    <div v-if="query_results">
      <ul>
       <li v-for="query_result in query_results" :key="query_result.number">
         <button @click="showRecord(query_result.number)">{{ (show_record_number !== query_result.number) ? 'Show' : 'Hide' }}</button>
         {{ query_result.basic.last_name }}, {{ query_result.basic.first_name }} {{ query_result.basic.middle_name }}
         <div v-if="(show_record_number === query_result.number)"><NpiRecord :record="query_result"/></div>
       </li>
      </ul>
    </div>

    <div v-if="test_result">{{ test_result }}</div>
  </div>
</template>
<script>
  import NpiRecord from './NpiRecord.vue'

  export default {
    components: {
      NpiRecord
    },
    data() {
      return {
        show_record_number   : -1,

        first_name           : "",
        last_name            : "",
        npi_number           : "",
        taxonomy_description : "",
        city                 : "",
        state                : "",
        zip_code             : "",

        test_result          : "",
        query_results        : [],

        formSubmitted        : false
      };
    },
    methods: {
      submitForm: function () {
        this.formSubmitted = true

        fetch('/api/npi_query', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body:  JSON.stringify({
              'first_name'           : this.first_name,
              'last_name'            : this.last_name,
              'npi_number'           : this.npi_number,
              'taxonomy_description' : this.taxonomy_description,
              'city'                 : this.city,
              'state'                : this.state,
              'zip_code'             : this.zip_code,
            }),
          }).then(response => response.json())
            .then(data => {
              this.query_results = data['results']
            })
            .catch(err => console.log(err))
      },
      anotherSearch: function () {
        this.formSubmitted = false
      },
      showRecord: function(record_id) {
        // Open a new record and close old one -- or just close one, if it's already open
        this.show_record_number = (this.show_record_number === record_id) ? -1 : record_id
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
