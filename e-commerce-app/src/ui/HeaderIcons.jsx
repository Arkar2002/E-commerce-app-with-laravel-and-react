import {
  HiMiniUserCircle,
  HiOutlineHeart,
  HiShoppingCart,
} from "react-icons/hi2";
import { Link } from "react-router-dom";

function HeaderIcons({ user = {} }) {
  const iconClass = {
    container:
      "text-center text-gray-700 transition relative flex flex-col justify-center items-center hover:text-primary",
    icon: "text-2xl",
    text: "text-xs leading-3",
    text2:
      "absolute right-0 text-white -top-1 w-5 h-5 rounded-full bg-primary flex items-center justify-center text-xs",
  };

  const { likeCount, cartCount } = user;

  return (
    <div className="flex items-center space-x-4">
      <Link to="/" className={iconClass.container}>
        <div className={iconClass.icon}>
          <HiOutlineHeart />
        </div>
        <div className={iconClass.text}>Wish List</div>
        <span className={iconClass.text2}>{likeCount}</span>
      </Link>
      <Link to="/" className={iconClass.container}>
        <div className={iconClass.icon}>
          <HiShoppingCart />
        </div>
        <div className={iconClass.text}>Cart List</div>
        <span className={iconClass.text2}>{cartCount}</span>
      </Link>
      <Link to="account" className={iconClass.container}>
        <div className={iconClass.icon}>
          <HiMiniUserCircle />
        </div>
        <div className={iconClass.text}>{user.name}</div>
      </Link>
    </div>
  );
}

export default HeaderIcons;
