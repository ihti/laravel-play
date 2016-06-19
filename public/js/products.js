var vm = new Vue({
    el: '.container',
    data: {
        products: [],
        total: 0,
        form: null
    },
    created: function() {
        $.get('/products', function(data) {
            vm.products = data;
        });
    },
    computed: {
        total: function() {
            let total = 0;
            this.products.forEach(function(product) {
              total += product.price * product.qty;
            });
            return total;
        }
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
