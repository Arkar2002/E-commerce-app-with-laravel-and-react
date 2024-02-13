import { Link } from "react-router-dom";
import Button from "../ui/Button";
import Container from "../ui/Container";
import FormRow from "../ui/FormRow";
import Heading from "../ui/Heading";
import Input from "../ui/Input";

function Register() {
  return (
    <Container classname="py-16">
      <div className="mx-auto max-w-lg overflow-hidden rounded px-6 py-7 shadow">
        <Heading size="base" weight="semibold" classname="mb-1">
          Register
        </Heading>
        <p className="mb-6 text-sm text-gray-600">
          Login if you are a returning customer
        </p>
        <form action="">
          <FormRow label="Email">
            <Input
              type="email"
              id="email"
              placeholder="Enter Your Email Address"
            />
          </FormRow>

          <FormRow label="Password">
            <Input
              type="password"
              id="password"
              placeholder="Enter Your Password"
            />
          </FormRow>

          <Button display="block" className="w-full">
            LOGIN
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

export default Register;
