import { FaFacebook, FaInstagram, FaLinkedin, FaTwitter } from "react-icons/fa";
import Logo from "./Logo";
import SocialIcon from "./SocialIcon";
import Heading from "./Heading";

function Footer() {
  return (
    <footer className="border-t border-gray-100 bg-white py-12">
      <div className="container grid grid-cols-3 gap-8 md:grid-cols-5">
        <div className=" space-y-8">
          <Logo />
          <p className="text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Perspiciatis quidem veniam incidunt alias nulla commodi.
          </p>

          <div className="flex space-x-6">
            <SocialIcon
              href="http://www.facebook.com/"
              title="Facebook"
              icon={<FaFacebook />}
            />

            <SocialIcon
              href="http://www.twitter.com/"
              title="Facebook"
              icon={<FaTwitter />}
            />

            <SocialIcon
              href="http://www.instagram.com/"
              title="Facebook"
              icon={<FaInstagram />}
            />

            <SocialIcon
              href="http://www.linkedin.com/"
              title="Facebook"
              icon={<FaLinkedin />}
            />
          </div>
        </div>
        <div className="">
          <Heading
            size="sm"
            fontWeight="semibold"
            textColor={"text-gray-400"}
            classname={"mb-5 tracking-wider"}
          >
            Solutions
          </Heading>
          <div className="flex flex-col space-y-4">
            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Marketing
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Analytics
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Commerce
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Insights
            </a>
          </div>
        </div>

        <div className="">
          <Heading
            size="sm"
            fontWeight="semibold"
            textColor={"text-gray-400"}
            classname={"mb-5 tracking-wider"}
          >
            Supports
          </Heading>
          <div className="flex flex-col space-y-4">
            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Marketing
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Analytics
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Commerce
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Insights
            </a>
          </div>
        </div>

        <div className="">
          <Heading
            size="sm"
            fontWeight="semibold"
            textColor={"text-gray-400"}
            classname={"mb-5 tracking-wider"}
          >
            Company
          </Heading>
          <div className="flex flex-col space-y-4">
            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Marketing
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Analytics
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Commerce
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Insights
            </a>
          </div>
        </div>

        <div className="">
          <Heading
            size="sm"
            fontWeight="semibold"
            textColor={"text-gray-400"}
            classname={"mb-5 tracking-wider"}
          >
            Legal
          </Heading>
          <div className="flex flex-col space-y-4">
            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Marketing
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Analytics
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Commerce
            </a>

            <a href="#" className="text-base text-gray-500 hover:text-gray-800">
              Insights
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
