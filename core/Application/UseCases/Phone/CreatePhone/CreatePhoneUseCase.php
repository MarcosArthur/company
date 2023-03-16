<?php


namespace Core\Application\UseCases\Phone\CreatePhone;

use Core\Application\UseCases\Phone\CreatePhone\DTO\{PhoneCreateInputDTO, PhoneCreateOutputDTO};
use Core\Domain\Phone\Repository\PhoneRepositoryInterface;
use Core\Domain\Phone\Entity\Phone;

class CreatePhoneUseCase
{

    private $input;
    private $repository;

    public function __construct(PhoneCreateInputDTO $input, PhoneRepositoryInterface $repository)
    {
        $this->input = $input;
        $this->repository = $repository;
    }

    public function handle(): PhoneCreateOutputDTO
    {

        $data = $this->input->getData();

        $phone = new Phone($data['phones'], $data['supplier']);

        $phone->validate();

        $response = $this->repository->create($data);

        return new PhoneCreateOutputDTO($data['phones']);
    }
}
