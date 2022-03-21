<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.products.update',$product->id)}}">
                  @csrf
                  @method('put')
                  <div class="flex flex-col space-y-2">
                    <label for="name" class="text-gray-700 select-none font-medium">name</label>
                    <input id="name" type="text" name="name" value="{{ $product->name }}"
                      placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
        
                <div class="flex flex-col space-y-2">
                    <label for="price" class="text-gray-700 select-none font-medium">price</label>
                    <input id="price" type="text" name="price" value="{{ $product->price }}"
                      placeholder="Enter price" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="quantity" class="text-gray-700 select-none font-medium">quantity</label>
                    <input id="quantity" type="text" name="quantity" value="{{ $product->quantity }}"
                      placeholder="Enter quantity" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
              
                <div class="flex flex-col space-y-2">
                    <label for="product_image" class="text-gray-700 select-none font-medium">Choose Product Image</label>
                    <input id="product_image" type="file" name="product_image" value="{{$product->product_image}}" onchange="priviewFile(this)"/>
                    <img id="preview_img" alt="product_image" src="{{asset('img')}}/{{$product->product_image}}" width="300px"/>
                </div>
    
                <h3 class="text-xl my-4 text-gray-600">Role</h3>
                <div class="grid grid-cols-3 gap-4">
                  <div class="relative inline-flex">
                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                    <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="publish">
                      <option value="0">Draft</option>
                      <option value="1" @if($product->publish) selected @endif>Publish</option>
                    </select>
                  </div>
                </div>
                <div class="text-center mt-16 mb-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                </div>
              </div>

             
            </div>
        </main>
    </div>
</div>
</x-app-layout>
<script>
  function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $('#preview_img').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
