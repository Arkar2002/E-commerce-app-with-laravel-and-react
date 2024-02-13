import { useState } from "react";
import { useProductDetails } from "./useProductDetails";
import { formatCurrency } from "../../util/helper";
import { FaShoppingCart } from "react-icons/fa";
import { HiHeart } from "react-icons/hi2";
import BreadCrums from "../../ui/BreadCrums";
import Container from "../../ui/Container";
import Heading from "../../ui/Heading";
import StarRating from "../../ui/StarRating";
import Button from "../../ui/Button";
import ProductItem from "./ProductItem";
import Spinner from "../../ui/Spinner";
import parse from "html-react-parser";
import BackButton from "../../ui/BackButton";
import toast from "react-hot-toast";

function ProductDetail() {
  const [selectColor, setSelectColor] = useState(null);
  const [quantity, setQuantity] = useState(1);
  const { data: { product, relatedProducts } = [], isLoading } =
    useProductDetails();

  const colors = {
    Black: "bg-black",
    White: "bg-white",
    Grey: "bg-gray-400",
    Silver: "bg-silver",
    Pink: "bg-pink",
  };

  function handleClick(color) {
    setSelectColor(color);
  }

  function handleIncrease() {
    if (quantity === product.quantity) {
      toast.error("You can't add more quantity");
      return;
    }
    setQuantity((quantity) => quantity + 1);
  }

  function handleDecrease() {
    if (quantity === 1) return;
    setQuantity((quantity) => quantity - 1);
  }

  return (
    <Container>
      {isLoading ? (
        <div className="mt-24">
          <Spinner />
        </div>
      ) : (
        <>
          <div className="my-4">
            <BreadCrums />
          </div>
          <BackButton />
          <div className="grid grid-cols-2 gap-6">
            <div>
              <img src={product.image} className="w-full" alt={product.name} />
            </div>
            <div>
              <Heading size="md">{product.name}</Heading>
              <div className="space-y-3">
                <div className="flex items-center gap-3">
                  <StarRating
                    disabled={true}
                    size={30}
                    text={false}
                    defaultRating={product.rating}
                    maxRating={5}
                  />
                  <span className="text-sm text-gray-600">
                    {/* add later */}
                    {/* ({product.review} Reviews) */}
                  </span>
                </div>
                <p>
                  <span className="font-medium">Avilability :</span>
                  {product.quantity > 0 ? (
                    <span className="text-green-600">&nbsp; In stock</span>
                  ) : (
                    <span className="text-rose-600">&nbsp; Out of stock</span>
                  )}
                </p>
                <p>
                  <span className="font-medium">Brand :</span>
                  <span className="text-gray-600">
                    &nbsp; {product.brand?.title}
                  </span>
                </p>
                <p>
                  <span className="font-medium">Category :</span>
                  <span className="text-gray-600">
                    &nbsp; {product.category?.title.toUpperCase()}
                  </span>
                </p>
                <div className="flex items-center space-x-4">
                  <Heading classname="my-3" textColor="text-primary">
                    {formatCurrency(product.salePrice - product.discountPrice)}
                  </Heading>
                  <p className="text-sm text-gray-400 line-through">
                    {formatCurrency(product.discountPrice)}
                  </p>
                </div>
                <div className="space-y-8">
                  <div>
                    <span className="mb-4 mt-2 inline-block">
                      Color (Please choose a color)
                    </span>
                    <div className="flex flex-col space-y-4">
                      <div className="flex items-center space-x-4">
                        {product.color?.map((color) => (
                          <button
                            onClick={() => handleClick(color.title)}
                            className={`h-8 w-8 border border-gray-300 ${colors[color.title]} ring-primary ${selectColor === color.title && "ring"}`}
                            title={color.title}
                          ></button>
                        ))}
                      </div>
                      {selectColor && (
                        <span className="text-green-500">
                          You chose {selectColor} color
                        </span>
                      )}
                    </div>
                  </div>
                  <div>
                    <label className="mb-4 mt-8 block">Quantity</label>
                    <div className="flex items-center space-x-2">
                      <button
                        className="flex h-8 w-8 items-center justify-center border border-gray-200 bg-primary text-xl text-white focus:ring"
                        onClick={handleDecrease}
                      >
                        -
                      </button>
                      <span className="text-lg">{quantity}</span>
                      <button
                        className="flex h-8 w-8 items-center justify-center border border-gray-200 bg-primary text-xl text-white focus:ring"
                        onClick={handleIncrease}
                      >
                        +
                      </button>
                    </div>
                    {quantity > 1 && (
                      <div className="my-4 flex items-center gap-2">
                        <Heading size="sm" classname="">
                          Total Price :{" "}
                        </Heading>
                        <span className="text-xl text-gray-800">
                          {formatCurrency(
                            quantity *
                              (product.salePrice - product.discountPrice),
                          )}
                        </span>
                      </div>
                    )}
                  </div>

                  <div className="flex gap-6">
                    <Button size="md">
                      <span className="flex items-center space-x-2">
                        <FaShoppingCart />
                        <span>ADD TO CART</span>
                      </span>
                    </Button>
                    <Button size="md" type="secondary">
                      <span className="flex items-center space-x-2">
                        <HiHeart />
                        <span>WISHLIST</span>
                      </span>
                    </Button>
                  </div>

                  <span className="inline-block w-5/6 border-b border-gray-200"></span>
                </div>
              </div>
            </div>
          </div>
          <div className="mt-20">
            <Heading size="sm">Product Detail</Heading>
            <hr />
            <div className="w-3/5 pt-6">
              <p className="text-gray-700">{parse(product.description)}</p>
            </div>
          </div>
          <div className="mt-10">
            <Heading>Related Products</Heading>
            {relatedProducts.length > 0 ? (
              <div className="grid grid-cols-4 gap-4">
                {relatedProducts?.map((product) => (
                  <ProductItem key={product.slug} product={product} />
                ))}
              </div>
            ) : (
              <div className="text-gray-600">No related products</div>
            )}
          </div>
        </>
      )}
    </Container>
  );
}

export default ProductDetail;
