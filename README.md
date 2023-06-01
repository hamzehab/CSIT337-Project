# FastAPI and Tortoise ORM Pytest TDD

## Initial Setup
- Clone Repository
- Ensure `Docker` is installed
- Install Python 3.10 or 3.11, with `py` launcher, make sure to add to PATH (*if you haven't done so*)

## Updating
- If new libraries are needed, edit `requirements.txt`
- Let anyone using an old version know
- Release updates

## Running
- Make sure you are in the `fastapi-test` directory
- To create docker containers or update them if already created, run the following command:
    - Windows: `docker-compose up -d --build`
- Run `pytest.py` tests:
    - With warnings: `docker exec -it fastapi-test-backend-1 pytest src/tests.py`
    - Without warnings: `docker exec -it fastapi-test-backend-1 pytest -W ignore::DeprecationWarning src/tests.py`
