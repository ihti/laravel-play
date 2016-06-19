<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Products</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </head>


    <body>
        <div class="container">

            <h3>Products</h3>
            <hr>


            <div class="form">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Add new product</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form">
                                    <input type="hidden" name="id" v-model="form.id">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" value="" v-model="form.name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Quantity</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="qty" value="" v-model="form.qty">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Price</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="price" v-model="form.price">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="button" class="btn btn-primary" v-on:click="saveProduct()">
                                                <i class="fa fa-btn fa-user"></i>Add
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <table class="table">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Qty</td>
                        <td>Price</td>
                        <td>Created</td>
                        <td>Total</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tr v-for="product in products">
                    <td>@{{product.name}}</td>
                    <td>@{{product.qty}}</td>
                    <td>@{{product.price}}</td>
                    <td>@{{product.created_at}}</td>
                    <td>@{{product.price * product.qty}}</td>
                    <td>
                        <a class="btn btn-danger btn-xs" v-on:click="deleteProduct(product.id)">delete</a>
                        <a class="btn btn-info btn-xs" v-on:click="editProduct(product)">edit</a>
                    </td>
                </tr>
            </table>
        </div>
    </body>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.25/vue.min.js"></script>
    <script type="text/javascript">


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
                },

                updateProduct: function() {
                    $.ajax({
                        url: '/products/' + vm.form.id,
                        type: 'PATCH',
                        data: vm.form,
                        success: function(result) {
                            vm.products.push(result, 1);
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

    </script>
</html>
