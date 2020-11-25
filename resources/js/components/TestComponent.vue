<template>
  <div>
    <vue-multi-select
      ref="multiSelect"
      v-model="values"
      search
      historyButton
      :options="options"
      :filters="filters"
      :btnLabel="btnLabel"
      @open="open"
      @close="close"
      :selectOptions="test">
      <template v-slot:option="{option}">
        <input name="text[]" type="checkbox" :checked="option.selected"/>
          
        <span>{{option}}</span>
      </template>
      <input v-show="this.values" type="text">
    </vue-multi-select>
    <button
      @click="openManually">
      Open manually
    </button>
    <p v-show="text">testing...</p>
    {{this.values}}
  </div>
</template>

<script>
import vueMultiSelect from 'vue-multi-select';
import 'vue-multi-select/dist/lib/vue-multi-select.css';


export default {
  data() {
    return {
        test: [
          { name: 'a' },
          { name: 'b' },
          { name: 'c' },
          { name: 'd' },
          { name: 'e' },
        ],
      btnLabel: values => `A simple vue multi select (${values.length})`,
      name: 'first group',
      values: [],
      data: [{
        name: 'first group',
        list: [
          { name: '0' },
          { name: '2' },
          { name: '3' },
          { name: '8' },
          { name: '9' },
          { name: '11' },
          { name: '13' },
          { name: '14' },
          { name: '15' },
          { name: '18' },
        ],
      }, {
        name: 'second group',
        list: [
          { name: '21' },
          { name: '22' },
          { name: '24' },
          { name: '27' },
          { name: '28' },
          { name: '29' },
          { name: '31' },
          { name: '33' },
          { name: '35' },
          { name: '39' },
        ],
      }],
      filters: [{
        nameAll: 'Select all',
        nameNotAll: 'Deselect all',
        func() {
          return true;
        },
      }, 
      {
        nameAll: 'select <= 10',
        nameNotAll: 'Deselect <= 10',
        func(elem) {
          return elem.name <= 10;
        },
      }, {
        nameAll: 'Select contains 2',
        nameNotAll: 'Deselect contains 2',
        func(elem) {
          return elem.name.indexOf('2') !== -1;
        },
      }],
      options: {
        multi: true,
        groups: false,
      },
    };
  },
  methods: {
    openManually() {
      this.$refs.multiSelect.openMultiSelect();
    },
    open() {
      console.log('open');
    },
    close() {
      console.log('close');
    },
  },
  components: {
    vueMultiSelect,
  },
};
</script>