<h1>Aqui van los productos listados</h1>

@forech($products as $product
    <ul>
        
            <li>{{ $product->name }}
           <button onclick="agregarAlCarrito({ $product })">Agregar al carrito</button>
        </li>
    </ul>

@endforeach  


 
<script>
    function agregarAlCarrito(productId){
        let posicion = carrito.findIndex(item => item.id === productId)
        if(posicion !== -1){
            //si existe el producto en el carrito, aumentamos la cantidad   
            carrito[posicion].cantidad++

        }else{
            //No existe el producto, solo se agrega
             producto.cantidad = 1
             carrito.push(product)
        }
        console.log(carrito)
       
    }
    function mostrarCarrito(){
        let divCarrito = document.getElementById('carrito')
        divCarrito.innerHTML = ''
        carrito.map(item => {
            divCarrito.innerHTML += `<p>${item.name} : ${item.cantidad}</p>`
        });
    }

</script>
