<?php

class Product extends Base
{
    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 2;

    public $name;

    public $price;

    public $description;

    public $code;

    public $discount;

    public $categoryId;

    public $vendorId;

    public $weight;

    public $type;

    public $status;

    public function getCategory()
    {
        return new Category($this->categoryId);
    }

    public function getVendor()
    {
        return new Vendor($this->vendorId);
    }

    public function getPrice()
    {
        $price = intval($this->price - $this->price * $this->discount/100);

    }


    public function getFinalPrice(){
        $price = intval($this->price - $this->price * $this->discount/100);

        if ($this->type=='service') {
            $parentProductId = getEWParentProductId($this->getId());
//            var_dump($parentProductId);die;

            if (!is_null($parentProductId)) {
                $parentProduct = new Product($parentProductId);
                $price = ($parentProduct->getFinalPrice() * $this->discount / 100);
            } else {
                $price = 0;

            }
        }

        if ($this->type=='delivery'){
            if (getCurrentCart()!=null){
                $crtCartIWeight = getCurrentCart()->getWeight();
                $price = $this->price * $crtCartIWeight ;
         }
        }
//        var_dump($price);die;
        if (isset($price)){
            return $price;
        } else {
            return 0;
        }

    }

    public function getImages(){
        $images = [];
    $imageList = Image::findBy('productId',$this->getId());

    if (!$imageList) {
        $images = new Image();
        $images->file = 'no_image.png';
        $images->productId = $this->getId();
//        $images = [
//            'file' => 'no_image.png',
//            'productId' => $this->getId(),
//            ];
    } else {
        foreach ($imageList as $ImageItem) {
            $images[] = $ImageItem;
        }
    }
    return $images;
    }


    public function getFirstImage()
    {
        $images = $this->getImages();
//        var_dump($images);die;
//        if(isset($images[0])){
////            var_dump($images);die;
//            return $images[0];
//        } else {
            $image = new Image();
            $image->file = 'no_image.png';
            $image->productId = $this->getId();
//            $image = [
//                    'file' => 'no_image.png',
//                    'productId' => $this->getId(),
//                ];
                return $image;
        }
//    }

    public function getEW(){

        if($this->type!='product'){
            return [];
        }

        $data = query("SELECT * FROM products WHERE type LIKE 'service';");
        $ewproducts = [];

        foreach ($data as $item){
            $product = new ProductEW($item['id']);
            $product->parentProduct = $this;
            $ewproducts[] = $product;
        }
        return $ewproducts;
    }

    public function card(){

        $productHtml = '<div class="col">
            <div class="card h-80" style="width: 18rem;">
                <a href="product.php?id='.$this->getId().'"><img src="./images/'.$this->getFirstImage()->file.'" class="card-img-top m-0" alt="'.$this->getName().'"></a>
                <div class="card-body text-center">
                    <h6 class="card-title">
                        <a class="card-text text-decoration-none lh-1" href="#">
                            <p class="text-truncate text-decoration-none text-dark">'.$this->getName().'</p>
                        </a>
                        <p><a href="vendor.php?id='.$this->vendorId.'">'.$this->getVendor()->name.'('.count($this->getVendor()->getProducts()).')</a></p>
                    </h6>
                    <div class="mt-2 col text-center">
                            <div class="col">
                            <h6>
                                <span class="mt-2 p-0 fs-6 text-decoration-line-through">'.$this->price.'RON</span>
                                <span class="product-this-deal">(-'.$this->discount.' %)</span>
                            </h6>
                                <h3 class="fs-4">'.$this->getFinalPrice().' Lei</h3>
                            </div>
                            <div class="col">';
            foreach ($this->getEW() as $extraWarranty){
                $productHtml.='<a href="userCart.php?id='.$extraWarranty->getId().'&parentId='.$this->getId().'" class="btn btn-info">+ '.$extraWarranty->name.'('.$extraWarranty->getFinalPrice().' RON)</a>';
            }
                $productHtml.= '<a href="userCart.php?id='.$this->getId().'" class="btn btn-primary">Adauga in cos</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>' ;
            echo $productHtml;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public static function getTableName()
    {
        return 'products';
    }

}