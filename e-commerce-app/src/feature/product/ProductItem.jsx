import { Link, useNavigate } from "react-router-dom";
import Button from "../../ui/Button";
import InfoButton from "../../ui/InfoButton";
import LikeButton from "../../ui/LikeButton";
import StarRating from "../../ui/StarRating";
import Heading from "../../ui/Heading";
import { formatCurrency } from "../../util/helper";
import { useAddProductLike } from "./useAddProductLike";
import { HiHeart, HiOutlineHeart } from "react-icons/hi2";
import SpinnerMini from "../../ui/SpinnerMini";
import { useContextProvider } from "../../context/ContextProvider";
import toast from "react-hot-toast";
import { useRemoveProductLike } from "./useRemoveProductLike";
import { useAddToCart } from "../cart/useAddToCart";

function ProductItem({ product, productLikes = [], isLoading, carts = [] }) {
  const { hasUser } = useContextProvider();
  const { mutate: productLike, isPending } = useAddProductLike();
  const { mutate: productUnlike, isPending: isPending2 } =
    useRemoveProductLike();
  const { mutate: productAddToCart, isPending: isPending3 } = useAddToCart();
  const link = `/shop/${product?.slug}`;
  const navigate = useNavigate();

  function addToCart(e) {
    e.preventDefault();
    if (isPending3) return;
    productAddToCart({ product_id: product.id, qty: 1 });
  }

  function handleLike(type) {
    if (!hasUser) {
      toast.error("Please Login in first");
      navigate("/login");
      return;
    }
    if (isPending) return;
    if (type === "like") productLike({ product_id: product.id });
    else {
      const filterProductLikes = productLikes?.filter(
        (data) => data !== product.id,
      );
      productUnlike({ data: filterProductLikes, product_id: product.id });
    }
  }

  return (
    <>
      {product ? (
        <Link
          to={link}
          className="flex flex-col justify-between overflow-hidden rounded bg-white shadow"
        >
          <div>
            <div className="group relative cursor-pointer">
              <img
                src={product.image}
                className="h-auto w-auto max-w-72 object-cover object-center"
                alt={product.name}
              />
              <div className="absolute inset-0 hidden items-center justify-center gap-2 bg-black bg-opacity-30 group-hover:flex">
                <div className="info-ani">
                  <InfoButton to={link} />
                </div>
                <div className="heart-ani">
                  {isPending || isLoading || isPending2 ? (
                    <LikeButton icon={<SpinnerMini />} disabled={true} />
                  ) : productLikes?.includes?.(product.id) ? (
                    <LikeButton
                      onClick={() => handleLike("unlike")}
                      icon={<HiHeart />}
                      disabled={isPending || isPending2 || isLoading}
                    />
                  ) : (
                    <LikeButton
                      onClick={() => handleLike("like")}
                      icon={<HiOutlineHeart />}
                      disabled={isPending || isPending2 || isLoading}
                    />
                  )}
                </div>
              </div>
            </div>
            <div className="px-4">
              <Link
                to={link}
                className="mb-2 text-lg font-medium uppercase text-gray-800 transition hover:text-primary"
              >
                {product.name}
              </Link>
              <div className="flex items-baseline gap-x-2">
                <Heading
                  size="sm"
                  classname="mb-2"
                  weight="semibold"
                  textColor="text-primary"
                >
                  {formatCurrency(product.salePrice - product.discountPrice)}
                </Heading>
                {product.discountPrice > 0 && (
                  <p className="text-sm text-gray-400 line-through">
                    {formatCurrency(product.salePrice)}
                  </p>
                )}
              </div>
              <div className="mb-3 flex items-center gap-x-3">
                <div className="flex gap-1">
                  <StarRating
                    disabled={true}
                    size={30}
                    text={false}
                    defaultRating={5}
                    maxRating={5}
                  />
                </div>
                <p className="text-sm text-gray-500">(150)</p>
              </div>
            </div>
          </div>
          <div className="px-4 pb-5">
            {carts.includes(product.id) ? (
              <Link
                to={"/user"}
                className="block rounded-md border border-primary px-2 py-1 text-center text-xs md:text-sm"
              >
                Added
              </Link>
            ) : (
              <Button
                onClick={addToCart}
                className="w-full"
                display="block"
                size="sm"
                disabled={isPending3}
              >
                {isPending3 ? <SpinnerMini /> : "Add To Cart"}
              </Button>
            )}
          </div>
        </Link>
      ) : (
        ""
      )}{" "}
    </>
  );
}

export default ProductItem;
