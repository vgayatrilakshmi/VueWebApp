new Vue({
  el: '#app',
  data: function data() {
    return {
        dialog: false,
        search: '',
        headers: [
                  { text: 'First Name', align: 'left', value: 'Fname'}, 
                  { text: 'Last Name', value: 'Lname' }, 
                  { text: 'Middle Name', value: 'Mname' }, 
                  { text: 'Actions', value: 'name', sortable: false }
                ],
        employees: [],
        editedIndex: -1,
        editedItem: { Fname: '', Lname: '',  Mname: '' },
        defaultItem: { Fname: '', Lname: '', Mname: '' }
    };
  },

  computed: {
    formTitle: function formTitle() {
      return this.editedIndex === -1 ? 'New Employee' : 'Edit Employee';
    }
  },

  watch: {
    dialog: function dialog(val) {
      val || this.close();
    }
  },

  created: function created() {
    this.initialize();
  },

  methods: {

    initialize: function initialize() {
      this.employees = [{ Fname: 'Zak', Lname: 'Sy', Mname: 'I'}, 
                        { Fname: 'Shruthi', Lname: 'Thandra', Mname: 'L'},
                        { Fname: 'Teresa', Lname: 'Rael', Mname: 'J'}
                      ];

    },

    editItem: function editItem(item) {
      this.editedIndex = this.employees.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem: function deleteItem(item) {
      var index = this.employees.indexOf(item);
      confirm('Are you sure you want to delete this item?') && this.employees.splice(index, 1);
    },

    close: function close() {
      var _this = this;
      this.dialog = false;
      setTimeout(function () {
        _this.editedItem = Object.assign({}, _this.defaultItem);
        _this.editedIndex = -1;
      }, 300);
    },

    save: function save() {
      if (this.editedIndex > -1) {
        Object.assign(this.employees[this.editedIndex], this.editedItem);
      } else {
        this.employees.push(this.editedItem);
      }
      this.close();
    }

  }
});
