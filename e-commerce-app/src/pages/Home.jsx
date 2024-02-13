import { useCategories } from "../feature/category/useCategories";
import ProductItem from "../feature/product/ProductItem";
import useNewArrivalProduct from "../feature/product/useNewArrivalProduct";
import { useRecommandProduct } from "../feature/product/useRecommandProduct";
import Banner from "../ui/Banner";
import CategoriesBox from "../ui/CategoriesBox";
import Container from "../ui/Container";
import DiscountOffer from "../ui/DiscountOffer";
import Feature from "../ui/Feature";
import FullPageSpinner from "../ui/FullPageSpinner";
import Heading from "../ui/Heading";

function Home() {
  const { data: categories = [], isLoading } = useCategories();
  const { data: newArrivals, isLoading: isLoading2 } = useNewArrivalProduct();
  const { data: recommand, isLoading: isloading3 } = useRecommandProduct();

  if (isLoading || isLoading2 || isloading3) return <FullPageSpinner />;

  return (
    <>
      <Banner />
      <Feature />
      <Container>
        <Heading>Shop By Category</Heading>
        <CategoriesBox categories={categories} />
      </Container>
      <Container>
        <Heading>Top New Arrival</Heading>
        <div className="grid grid-cols-2 gap-6 md:grid-cols-4">
          {newArrivals &&
            newArrivals.map((product) => (
              <ProductItem key={product.name} product={product} />
            ))}
        </div>
      </Container>
      <Container>
        <DiscountOffer />
      </Container>
      <Container>
        <Heading>Recommand for you</Heading>
        <div className="grid grid-cols-2 gap-6 md:grid-cols-4">
          {recommand &&
            recommand.map((product) => (
              <ProductItem key={product.name} product={product} />
            ))}
        </div>
      </Container>
    </>
  );
}

export default Home;
