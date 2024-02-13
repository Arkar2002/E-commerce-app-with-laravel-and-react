import { Link } from "react-router-dom";

function CategoriesBox({ categories }) {
  return (
    <>
      <div className="grid grid-cols-2 gap-3 md:grid-cols-3">
        {categories.map((category) => (
          <Link
            to={`/shop?categories=%25${category.title}`}
            key={category.title}
            className="flex cursor-pointer items-center gap-6 rounded-md border border-gray-200  px-10 py-2 shadow-md transition hover:bg-gray-100"
          >
            <img
              src={category.image}
              className="h-20 w-20 rounded-full object-cover object-center"
              alt=""
            />
            <span className="">
              {category.title.at(0).toUpperCase() + category.title.substring(1)}
            </span>
          </Link>
        ))}
      </div>
    </>
  );
}

export default CategoriesBox;
