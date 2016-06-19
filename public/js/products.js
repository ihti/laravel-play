var vm = new Vue({
    el: '.container',
    data: {
        products: [],
        form: null
    },
    created: function() {
        $.get('/products', function(data) {
            console.log(data);
            vm.products = data;
        });
    },
    methods: {
        saveProduct: function() {
            if (this.form.id) {
                this.updateProduct();
            } else {
                this.addProduct();
            }
        },

        addProduct: function() {
            $.post('/products', this.form,function(data) {
                vm.products.push(data);
                vm.form = null;
            });
        },

        editProduct: function(data) {
            vm.form = data;
            vm.editing = data;
        },

        updateProduct: function() {
            $.ajax({
                url: '/products/' + vm.form.id,
                type: 'PATCH',
                data: vm.form,
                success: function(result) {
                    vm.products.splice(vm.editing, 1);
                    vm.products.push(result);
                    vm.form = null;
                }
            });
        },

        deleteProduct: function(id, index) {
            $.ajax({
                url: '/products/' + id,
                type: 'DELETE',
                success: function(result) {
                    vm.products.splice(result, 1);;
                }
            });
        }
    }
})
