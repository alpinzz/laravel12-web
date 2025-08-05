 <x-homelayout>

     <x-body_home.partials.slider :sliders="$sliders" />

     <!-- end hero -->
     <div class="lonyo-content-shape1">
         <img src="{{ asset('frontend/assets/images/shape/shape1.svg') }}" alt="" />
     </div>


     <x-body_home.partials.news :blogs="$blogs" />

     <!-- end content -->

     <x-body_home.partials.about />
     <!-- end content -->

     <x-body_home.partials.structure :members="$members" />



     <x-body_home.partials.profile />


 </x-homelayout>
