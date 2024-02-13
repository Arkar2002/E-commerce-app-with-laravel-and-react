import { HiOutlineBars3 } from "react-icons/hi2";
import { Link } from "react-router-dom";
import { useCategories } from "../feature/category/useCategories";

function Categories() {
  const { data, isLoading } = useCategories();

  return (
    <>
      {!isLoading && (
        <div className="group relative flex items-center bg-primary px-8 py-4">
          <span className="me-2 text-white">
            <HiOutlineBars3 />
          </span>
          <span className="uppercase text-white sm:text-xs md:text-base">
            All Categories
          </span>
          <div className="absolute left-0 top-full z-10 hidden w-full divide-y-2 divide-dashed bg-white px-2 py-2 shadow-md group-hover:block">
            {data.map((data) => (
              <Link
                key={data.title}
                to={`/shop?category=${data.title}`}
                className="flex items-center px-6 py-2 transition hover:bg-gray-100"
              >
                <img
                  src={data?.image}
                  className="h-5 w-5 object-contain"
                  alt=""
                />
                <span className="ml-6 text-sm text-gray-600">
                  {data?.title.at(0).toUpperCase() + data.title.substring(1)}
                </span>
              </Link>
            ))}
          </div>
        </div>
      )}
    </>
  );
}

export default Categories;
