import { Link, useNavigate } from "react-router-dom";
import Button from "../ui/Button";
import Container from "../ui/Container";
import FormRow from "../ui/FormRow";
import Heading from "../ui/Heading";
import Input from "../ui/Input";
import BreadCrums from "../ui/BreadCrums";
import { FaEye, FaEyeSlash } from "react-icons/fa";
import { useState } from "react";
import toast from "react-hot-toast";
import { useLogin } from "../feature/auth/useLogin";
import SpinnerMini from "../ui/SpinnerMini";
import { useContextProvider } from "../context/ContextProvider";

function Login() {
  const { setToken } = useContextProvider();
  const [email, setEmail] = useState("user@example.com");
  const [password, setPassword] = useState("user123@");
  const [type, setType] = useState("password");
  const { mutate: login, isPending } = useLogin();
  const navigate = useNavigate();

  function handleSubmit(e) {
    e.preventDefault();
    if (!email || !password)
      return toast.error("Please fill in all of the fields");
    login(
      { email, password },
      {
        onSuccess: (data) => {
          if (data.status === "success") {
            toast.success(`Welcome back ${data?.user.name}`);
            if (data.token) setToken(data.token);
            navigate(-1);
          } else {
            toast.error("Provided password is incorrect. Try Again!");
          }
          setPassword("");
        },
        onSettled: () => {
          setPassword("");
        },
      },
    );
  }

  function handleClick() {
    setType((type) => (type === "password" ? "text" : "password"));
  }

  return (
    <Container classname="pt-4">
      <BreadCrums />
      <div className="mx-auto max-w-lg overflow-hidden rounded px-6 py-7 shadow">
        <Heading size="base" weight="semibold" classname="mb-1">
          Login
        </Heading>
        <p className="mb-6 text-sm text-gray-600">
          Login if you are a returning customer
        </p>
        <form onSubmit={handleSubmit}>
          <FormRow label="Email">
            <Input
              type="email"
              id="email"
              placeholder="Enter Your Email Address"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </FormRow>

          <div className="relative">
            <FormRow label="Password">
              <Input
                type={type}
                id="password"
                placeholder="Enter Your Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </FormRow>
            <button
              type="button"
              onClick={handleClick}
              className="absolute right-3 top-[50%] translate-y-[30%] text-xl text-primary"
            >
              {type === "password" ? <FaEye /> : <FaEyeSlash />}
            </button>
          </div>

          <Button display="block" className="w-full">
            {isPending ? <SpinnerMini /> : "LOGIN"}
          </Button>

          <p className="mt-6 text-center text-gray-600">
            Don't have an account?{" "}
            <Link
              to="/register"
              className="text-primary decoration-primary hover:underline"
            >
              Register Now
            </Link>
          </p>
        </form>
      </div>
    </Container>
  );
}

export default Login;
