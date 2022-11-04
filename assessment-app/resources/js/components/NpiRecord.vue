<template>
  <div v-if="record">
    <div>Prefix: {{ record.basic.name_prefix }} Credential: {{ record.basic.credential }}</div><br>
    <div>Created Epoch: {{ record["created_epoch"] }}</div>
    <div>Last Updated Epoch: {{ record["last_updated_epoch"] }}</div>
    <br>
    <div>Enumeration Type: {{ record["enumeration_type"] }}</div>
    <div>Number: {{ record["number"] }}</div>
    <br>
    <div v-if="record['addresses']">
      <b>Addresses</b>
      <div v-for="address in record.addresses">
        Address purpose:  {{ address.address_purpose }}<br>
        {{ address.address_1 }}<br>
        {{ address.city }}, {{ address.state }} {{ address.postal_code }}<br>
        Telephone: {{ address.telephone_number }}<br><br>
      </div>
    </div>

    <div v-if="record['taxonomies']">
      <b>Taxonomies</b>
      <div v-for="taxi in record.taxonomies">
        Code:  {{ taxi.code }}<br>
        Taxonomy Group:  {{ taxi.taxonomy_group ? taxi.taxonomy_group : 'None' }}<br>
        Description:  {{ taxi.desc }}<br>
        State:   {{ taxi.state }}<br>
        License Number:  {{ taxi.license }} {{ record.primary ? "Primary" : "" }}<br><br>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      record: {},
    },
  };
</script>
