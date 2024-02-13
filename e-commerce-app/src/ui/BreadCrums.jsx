import { HiChevronRight, HiHome } from "react-icons/hi2";
import { Link, useLocation } from "react-router-dom";

function BreadCrums() {
  const { pathname } = useLocation();

  const crumbs = pathname.split("/").filter((el) => el !== "");

  let currentLinks = "";

  return (
    <div className="flex items-center gap-2">
      <Link to={"/"} className="text-primary hover:text-gray-800">
        <HiHome />
      </Link>
      <div className="flex items-center space-x-1">
        {crumbs.map(function (crumb) {
          currentLinks += `/${crumb}`;
          return (
            <div className="flex items-center" key={crumb}>
              <HiChevronRight className="text-gray-600" />
              <Link
                to={currentLinks}
                className={`ms-2 text-gray-700 hover:text-primary ${crumbs.at(-1) === crumb ? "text-primary" : "text-gray-700"}`}
              >
                {crumb.replaceAll("%20", " ")}
              </Link>
            </div>
          );
        })}
      </div>
    </div>
  );
}

export default BreadCrums;
